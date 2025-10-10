<x-mail::message>
# Subscription Cancelled

Hi {{ $subscription->user->name }},

Your subscription to **{{ $subscription->vendor->name }}** has been cancelled successfully.

**Reason:** {{ $reason }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
