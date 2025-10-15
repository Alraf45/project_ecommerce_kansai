

@section('header')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Profil
            </h2>
        </div>
    </header>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-semibold">Nama</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="border rounded p-2 w-full">
                </div>

                <div class="mt-4">
                    <label class="block font-semibold">Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="border rounded p-2 w-full">
                </div>

                <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
