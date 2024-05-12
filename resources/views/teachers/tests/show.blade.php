<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="position: relative">
                    <h2>
                        {{ __("messages.test_result") }}
                    </h2>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>#</td>
                            <td>O'quvchi</td>
                            <td>Ishlangan vaqti</td>
                            <td>Baho</td>
                        </tr>
                        @foreach($scores as $item)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$item->user->surname. " ". $item->user->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->score}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
