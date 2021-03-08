@extends('layouts.app')

@section('content')
    <div class="card-box">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <h3 id="timer" class="my-0">70:00</h3>
            </div>
            <div class="col-md-6">
                <div class="border p-2">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, temporibus molestias. Veniam at ullam impedit saepe enim veritatis nobis deleniti.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic adipisci quidem nemo quis aliquam iusto aperiam eos. Voluptate recusandae voluptas aliquam molestiae natus autem deleniti dicta fugit aut, quos tempora?
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste commodi ea harum delectus labore voluptatem impedit. Maiores ea quos iste pariatur voluptates, ipsam doloribus hic sapiente ducimus voluptatibus saepe excepturi ipsum impedit minus assumenda. Sequi corporis asperiores reprehenderit. Voluptate porro dolore eius accusamus suscipit qui modi saepe laudantium facere illo?
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <form action="#" method="post" id="form-text">
                    <textarea name="text" id="summernote"></textarea>
                </form>
            </div>
            .col
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('public/js/timer.js') }}"></script>
    <script>
        $("#summernote").summernote({
            airMode: false,
            focus: true,
            height: 250,
            toolbar: false,
            placeholder: 'Type here...'
        })
    </script>
@endsection