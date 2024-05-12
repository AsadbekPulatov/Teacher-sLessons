<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" style="position: relative">
                    <h2>
                        {{$student}}
                    </h2>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td>#</td>
                            <td class="">{{ __("messages.lessons") }}</td>
                            <td>Baho</td>
                            <td>{{ __("messages.action") }}</td>
                        </tr>
                        @php $summ=0; $i=0 @endphp
                        @foreach($tasks as $item)
                            @php $summ+=$item->baho;
                                   $i++;@endphp
                            <tr>
                                <td id="username">{{$item->id}}</td>
                                <td>{{$item['lesson']->theme}}</td>
                                <td>{{$item->baho}}</td>
                                <td>
                                    <a href="{{route('task_download',[$item->id])}}"
                                       class="bi bi-download btn btn-info"></a>
                                    <button type="button" class="btn btn-primary bi bi-check" id="rateButton"
                                            onclick="showForm({{$item->id}})">

                                    </button>

                                    <button type="button" class="btn btn-danger" onclick="hideForm()" id="cancelButton"
                                            style="display: none; position: absolute; top: 0; right: 0;">
                                        <i class="bi bi-x"></i> Bekor qilish
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                        <tr class="border-3" >
                            <td class="table-danger">O'rtacha Baho</td>
                            <td></td>
                            <td class="table-danger"> {{$summ/$i}}</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="myForm" class="py-12" style="display: none;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <form action="{{route('check-save')}}" method="POST" class="">
                            @csrf
                            <label for="task_id">Vazifa raqami</label>
                            <input type="number" name="task_id" id="task_id" class="form-control mb-1" readonly>
                            <label for="baho">Baho:</label>
                            <input type="number" name="task_baho" class="form-control">
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function showForm($item_id) {
            document.getElementById('cancelButton').style.display = 'inline-block';
            document.getElementById('task_id').value = $item_id;

            document.getElementById('myForm').style.display = 'block';
        }

        function hideForm() {
            document.getElementById('cancelButton').style.display = 'none';
            document.getElementById('myForm').style.display = 'none';
        }
    </script>

    <!-- Modal -->


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </script>
</x-app-layout>
