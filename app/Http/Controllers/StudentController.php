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
        // Lấy tất cả sinh viên từ DB bằng Eloquent
        $students = Student::all();

        return response()->json([
            'message' => 'Lấy danh sách thành công!',
            'data' => $students
        ], 200);
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
        // Tìm sinh viên theo ID bằng Eloquent
        $student = Student::find($id);

        // Kiểm tra nếu không tìm thấy sinh viên
        if (!$student) {
            return response()->json([
                'message' => 'Không tìm thấy sinh viên này!'
            ], 404); // Trả về mã lỗi 404
        }

        return response()->json([
            'message' => 'Chi tiết sinh viên ' . $id,
            'data' => $student
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Tìm sinh viên cần sửa
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Không tìm thấy sinh viên để cập nhật!'], 404);
        }

        // 2. Kiểm tra dữ liệu gửi lên (Validation)
        // Lưu ý: email phải unique nhưng ngoại trừ chính ID hiện tại
        $validatedData = $request->validate([
            'name'       => 'sometimes|required|string|min:3',
            'email'      => 'sometimes|required|email|unique:students,email,' . $id,
            'age'        => 'sometimes|required|integer|min:18',
            'class_name' => 'sometimes|required|string',
        ]);

        // 3. Cập nhật vào Database
        $student->update($validatedData);

        return response()->json([
            'message' => 'Cập nhật thông tin sinh viên thành công!',
            'data'    => $student
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 1. Tìm sinh viên cần xóa
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Không tìm thấy sinh viên để xóa!'], 404);
        }

        // 2. Thực hiện xóa
        $student->delete();

        return response()->json([
            'message' => 'Đã xóa sinh viên khỏi hệ thống thành công!'
        ], 200);
    }
}
