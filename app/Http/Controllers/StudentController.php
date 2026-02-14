<?php

namespace App\Http\Controllers;

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
            'name'  => 'required|string|min:3',
            'email' => 'required|email',
            'age'   => 'required|integer|min:18',
        ]);

        // Bước 2: Xử lý chính (Ở đây ta tạm thời trả về JSON để xác nhận)
        return response()->json([
            'message' => 'Sinh viên ' . $validatedData['name'] . ' đã qua vòng kiểm duyệt!',
            'received_data' => $validatedData
        ], 201); // 201 là mã HTTP báo hiệu "Đã tạo mới thành công"
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
