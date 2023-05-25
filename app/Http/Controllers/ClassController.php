<?php

/**
 *  ClassController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Http\Requests\ClassRequest;
use App\Services\ClassService;
use Exception;
use Illuminate\Support\Facades\Log;
use Sentry\SentryLaravel\SentryFacade as Sentry;

/**
 * Class Controller
 *
 * @category CategoryName
 * @package  PackageName
 *
 * @author  Display Name <username@example.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class ClassController extends Controller
{
    /**
     * ClassService instance.
     *
     * @var ClassService $service
     */
    private $_service;

    /**
     * Class constructor.
     *
     * @param ClassService $service ClassService instance
     *
     * @return void
     */
    public function __construct(ClassService $service)
    {
        $this->_service = $service;
    }

    /**
     * Returns a list of classes.
     *
     * @return array List of classes
     */
    public function list()
    {
        return $this->_service->list();
    }

    /**
     * Returns the data of a class.
     *
     * @return mixed The data of a class
     */
    public function getData()
    {
        return $this->_service->getData();
    }

    /**
     * Shows the add class form.
     *
     * @return mixed The add class form
     */
    public function add()
    {
        return $this->_service->add();
    }

    /**
     * Inserts a new class.
     *
     * @param ClassRequest $request Request object
     *
     * @return mixed Result of the insert operation
     */
    public function insertClass(ClassRequest $request)
    {
        return $this->_service->insertClass($request);
    }

    /**
     * Shows the edit class form.
     *
     * @param int $id Class ID
     *
     * @return mixed The edit class form
     */
    public function edit($id)
    {
        return $this->_service->edit($id);
    }

    /**
     * Shows the details of a class.
     *
     * @param int $id Class ID
     *
     * @return mixed The details of a class
     */
    public function view($id)
    {
        return $this->_service->view($id);
    }

    /**
     * Returns the list of classes for the current user.
     *
     * @return array List of classes
     */
    public function myClass()
    {
        return $this->_service->myClass();
    }

    /**
     * Updates the data of a class.
     *
     * @param ClassRequest $request Request object
     * @param int          $id      Class ID
     *
     * @return mixed Result of the update operation
     */
    public function editClass(ClassRequest $request, $id)
    {
        return $this->_service->editClass($request, $id);
    }

    /**
     * Deletes a class.
     *
     * @param int $id Class ID
     *
     * @return mixed Result of the delete operation
     */
    public function delete($id)
    {
        return $this->_service->delete($id);
    }
}
