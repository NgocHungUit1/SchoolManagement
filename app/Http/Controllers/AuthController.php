<?php

/**
 *  AuthController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 * AuthController
 *
 * @category Authentication
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class AuthController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        // Check if the user is already authenticated
        if (!empty(Auth::check())) {
            // Redirect to the respective dashboard based on user type
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } elseif (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } elseif (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            } elseif (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
        }

        // Show the login form if not authenticated
        return view('auth.login');
    }

    /**
     * Authenticate the user based on the submitted credentials.
     *
     * @param Request $request Request object
     *
     * @return mixed Result of the insert operation
     */
    public function authLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;

        // Attempt to authenticate the user with the provided credentials
        if (Auth::attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $remember
        )) {
            Session::put('user', Auth::user());
            // Redirect to the respective dashboard
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard')
                    ->with('success', 'Hello Admin, Login successfully');
            } elseif (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard')
                    ->with('success', 'Hello Teacher, Login successfully');
            } elseif (Auth::user()->user_type == 3) {
                return redirect('student/dashboard')
                    ->with('success', 'Hello Student, Login successfully');
            }
        } else {
            // Redirect back to the login form with error message
            return redirect()->back()
                ->with('error', 'Please enter correct email and password');
        }
    }

    /**
     * Log out the currently authenticated user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authLogout()
    {
        Auth::logout();

        // Redirect to home page with success message
        return redirect(url(''))
            ->with('success', 'Logout successfully');
    }

    /**
     * Display the forgot password form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forgotPassword()
    {
        return view('auth.forgot_password');
    }

    /**
     * Process the forgot password form
     *
     * @param Request $request Request object
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        // Get the user with the provided email
        $user = User::getEmail($request->email);

        if (!empty($user)) {
            // Generate a new token and save it to the user record
            $user->remember_token = Str::random(30);
            $user->save();

            // Send the password reset link to the user's email
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            // Redirect back to forgot password form with success message
            return redirect()->back()
                ->with('success', 'Please check your email and reset password');
        } else {
            // Redirect back to forgot password form
            return redirect()->back()->with('error', 'Email Not Found');
        }
    }

    /**
     * Display the password reset form.
     *
     * @param $remember_token $request Request object
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function reset($remember_token)
    {
        // Get the user with the provided token
        $user = User::getToken(($remember_token));

        if (!empty($user)) {
            // Display the password reset form with user data
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            // Redirect to 404 error page if user not found
            abort(404);
        }
    }

    /**
     * Update the user's password and log them in.
     *
     * @param $token   token
     * @param Request $request $request Request object
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword($token, Request $request)
    {
        // Check if the new password and confirm password match
        if ($request->password == $request->confirm_password) {
            // Get the user with the provided token
            $user = User::getToken($token);

            if (!empty($user)) {
                // Update the user's password and save the record
                $user->password = Hash::make($request->password);
                $user->save();

                // Log the user in with the new password
                Auth::loginUsingId($user->id);

                // Redirect to the respective dashboard based
                if (Auth::user()->user_type == 1) {
                    return redirect('admin/dashboard')
                        ->with('success', 'Password reset successfully');
                } elseif (Auth::user()->user_type == 2) {
                    return redirect('teacher/dashboard')
                        ->with('success', 'Password reset successfully');
                } elseif (Auth::user()->user_type == 3) {
                    return redirect('student/dashboard')
                        ->with('success', 'Password reset successfully');
                }
            } else {
                // Redirect to 404 error page if user not found
                abort(404);
            }
        } else {
            // Redirect back to password reset form with error
            return redirect()->back()->with('error', 'Passwords do not match');
        }
    }
}
