{{-- <form id="attendanceReportForm" method="GET" action="{{ route('attendance.report') }}">
    <div class="form-group row">
        <label for="teacher_id" class="col-md-4 col-form-label text-md-right">{{ __('Teacher') }}</label>
        <div class="col-md-6">
            <select id="teacher_id" class="form-control" name="teacher_id" required>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="month" class="col-md-4 col-form-label text-md-right">{{ __('Month') }}</label>
        <div class="col-md-6">
            <select id="month" class="form-control" name="month" required>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>
        <div class="col-md-6">
            <select id="year" class="form-control" name="year" required>
                @for ($i = date('Y'); $i >= 2000; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Generate Report') }}
            </button>
        </div>
    </div>
</form> --}}
<form id="attendanceReportForm" method="GET" action="{{ route('attendance.report') }}">
    <div class="form-group row">
        <label for="teacher_id" class="col-md-4 col-form-label text-md-right">{{ __('Teacher') }}</label>
        <div class="col-md-6">
            <select id="teacher_id" class="form-control" name="teacher_id" required>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="month" class="col-md-4 col-form-label text-md-right">{{ __('Month') }}</label>
        <div class="col-md-6">
            <select id="month" class="form-control" name="month" required>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="year" class="col-md-4 col-form-label text-md-right">{{ __('Year') }}</label>
        <div class="col-md-6">
            <select id="year" class="form-control" name="year" required>
                @for ($i = date('Y'); $i >= 2000; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Generate Report') }}
            </button>
        </div>
    </div>
</form>
