<x-mail::message>
# Subscription Cancelled

Hi {{ $subscription->vendor->user->name }},
  <!-- <-- $vendor is undefined! -->

The user **{{ $user->name }}** has cancelled their subscription for your food plan.

**Reason:** {{ $reason }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
