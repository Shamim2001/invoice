@if (session('success'))
        <div class="bg-emerald-200 text-emerald-700 py-4 text-center" id="message">
            <p>{{session('success')}}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-300 text-black-200 py-4 text-center" id="message">
            <p>{{session('error')}}</p>
        </div>
    @endif
