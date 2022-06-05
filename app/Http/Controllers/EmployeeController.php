<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function getEmployees(Request $request)
    {
        $employees = Employee::with([
            'area' => function ($query) {
                $query->select('areas.id', 'areas.name');
            },
            'roles' => function ($query) {
                $query->select('roles.id', 'roles.name');
            },
        ])->search($request->search)
            ->orderBy('employees.id', 'ASC')
            ->simplePaginate(20);
        return response()->json(['employees' => $employees]);
    }

    public function store(EmployeeStoreRequest $request)
    {
        try {

            // GUARDADO GENERAL DE LA INFORMACIÓN
            $employee = new Employee($request->all());
            $employee->area_id = $request->area; // GUARDA EL ID DEL ÁREA
            $employee->save();

            // GUARDADO DE ROLES EN TABLA PIVOT
            if ($request->roles) foreach ($request->roles as $key => $role) $employee->roles()->attach($role);

            // ENVÍO DE RELACIONES AL CLIENTE
            $employee->area;
            $employee->roles;

            // RESPUESTA AL CLIENTE
            return response()->json([
                'msg' => 'Se guardó con éxito',
                'icon' => 'success',
                'employee' => $employee,
                'new' => true
            ]);

        } catch (\Exception $exception) {
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        try {
            // GUARDADO GENERAL DE LA INFORMACIÓN
            $employee->update([
                'name' => $request->name,
                'email' => $request->email,
                'sex' => $request->sex,
                'area_id' => $request->area['id'], // GUARDA EL ID DEL ÁREA,
                'bulletin' => $request->bulletin,
                '$description' => $request->description
            ]);

            $employee->roles()->detach(); // ELIMINACIÓN DE ROLES
            // REASIGNACIÓN O ACTUALIZACIÓN DE ROLES
            if ($request->roles)
                foreach ($request->roles as $role) {
                    if (is_array($role)) $employee->roles()->attach($role['id']);
                    else $employee->roles()->attach($role);
                }

            // ENVÍO DE RELACIONES AL CLIENTE
            $employee->area;
            $employee->roles;

            // RESPUESTA AL CLIENTE
            return response()->json([
                'msg' => 'Se guardó con éxito',
                'icon' => 'success',
                'employee' => $employee,
                'new' => false
            ]);
        } catch (\Exception $exception) {
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            // Eliminación del registro
            $employee->delete();
            return response()->json(['msg' => 'Se eliminó con éxito', 'icon' => 'success', 'employee' => $employee]);
        } catch (\Exception $exception) {
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }
}
