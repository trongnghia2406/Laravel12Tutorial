<?php

namespace App\Http\Controllers;
// Import model vào controller để sử dụng
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['message' => 'Danh sách sinh viên']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Bước 1: Quét an ninh
        $validatedData = $request->validate([
            'name'       => 'required|string|min:3',
            'email'      => 'required|email|unique:students,email',
            'age'        => 'required|integer|min:18',
            'class_name' => 'required|string',
        ]);

        // 2. Dùng Eloquent để lưu vào Database
        // Lệnh này sẽ tự động tạo một hàng mới trong bảng students
        $student = Student::create($validatedData);

        // 3. Trả về kết quả JSON kèm theo dữ liệu vừa lưu
        return response()->json([
            'message' => 'Sinh viên đã được lưu vào hệ thống!',
            'data'    => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(['message' => 'Chi tiết sinh viên ' . $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json(['message' => 'Cập nhật sinh viên ' . $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(['message' => 'Đã xóa sinh viên ' . $id]);
    }
}
