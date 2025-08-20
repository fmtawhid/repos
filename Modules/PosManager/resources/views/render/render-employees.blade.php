<option value="">{{ localize('Select a waiter') }}</option>
@forelse($employees as $employee)
    <option value="{{ $employee->id }}" @if ($loop->first)
        selected
    @endif>{{ $employee->full_name }}</option>
@empty
@endforelse
