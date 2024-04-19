<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select('name', 'username', 'email', 'phone', 'address')->get();
    }

    public function headings(): array
    {
        return ['Họ Tên', 'Tên đăng nhập(Duy nhất)', 'Email(Duy nhất)', 'Số Điện Thoại', 'Địa Chỉ', 'Mật khẩu', 'Tên Khóa học 1', 'Tên Khóa học 2', 'Tên Khóa học 3'];
    }
}
