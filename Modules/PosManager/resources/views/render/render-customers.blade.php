<option value="">{{ localize('Select customer') }}</option>
@forelse($customers as $customer)
    <option value="{{ $customer->id }}" @if ($loop->first)
        selected
    @endif>{{ $customer->full_name }}</option>
@empty
@endforelse
