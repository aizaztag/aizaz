<div>


    @forelse($notified as $noti)

          {{$noti->data['order_id']}}
    @empty

        No users found.

    @endforelse



</div>