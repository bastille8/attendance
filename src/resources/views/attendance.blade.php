@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')
<form class="form" action="/attendance" method="post">
    <div class="attendance-table">
        <table class="attendance-table__inner">
            <tr class="attendance-table__row">
                <th class="attendance-table__header">名前</th>
                <th class="attendance-table__header">勤務開始</th>
                <th class="attendance-table__header">勤務終了</th>
                <th class="attendance-table__header">休憩時間</th>
                <th class="attendance-table__header">勤務時間</th>
            </tr>
            @foreach ($stamps as $value)
            <tr class="attendance-table__row">
                <td class="attendance-table__item">{{ Auth::user()->name }}</td>
                <td class="attendance-table__item">{{ $value->work_in }}</td>
                <td class="attendance-table__item">{{ $value->work_out }}</td>
                <td class="attendance-table__item">{{ $value->stamps_day }}</td>
                <td class="attendance-table__item">{{ $value->stamps_day }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</form>
<style>
    svg.w-5.h-5 {
        width: 30px;
        height: 30px;
    }
</style>
{{ $stamps->links() }}
@endsection