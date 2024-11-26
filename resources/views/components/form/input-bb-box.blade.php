<div class="relative input-box z-0 w-full mb-5 group">
    <input type         = "{{$type??"text"}}"
           name         = "{{@$name}}"
           id           = "{{@$id}}"
           class        = "
                    block py-2.5 px-0 w-full
                    bg-transparent
                    text-sm text-gray-900
                    border-0 border-b-2 border-gray-300
                    appearance-none
                    focus:outline-none focus:ring-0 focus:border-blue-600
                    peer
                    {{@$class}}
                    "
           placeholder  = ""

           @if(isset($value))
               value="{{@$value}}"
           @endif

           @if(isset($required))
               required
           @endif
    />
    <label for          = "{{@$id}}"
           class        ="
                    absolute
                    text-sm
                    text-gray-500
                    duration-300
                    transform -translate-y-6 scale-75 top-3
                    z-10
                    origin-[0]
                    peer-placeholder-shown:scale-100
                    peer-placeholder-shown:translate-y-0
                    peer-focus:scale-75
                    peer-focus:-translate-y-6
                    peer-focus:font-medium
                    peer-focus:start-0
                    peer-focus:text-blue-600
           ">
        {{@$label}}
    </label>

</div>
