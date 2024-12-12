@if(count($roles))
    <h3 class="font-semibold">
        Вы имеете следующие роли:
    </h3>
    <p>
        @php echo implode(', ',$roles) @endphp
    </p>
    <hr class="my-3">
@endif
