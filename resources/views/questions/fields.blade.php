<!-- Question Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('question_type', 'Question Type:') !!}
    <select name="question_type" class="form-control">
        <option value="multiple-choice">Multiple Choice</option>
        <option value="boolean">Boolean</option>
        <option value="multiple-response">Multiple Response</option>
        <option value="fill-in">Fill-In</option>
        <option value="essay">Essay</option>
    </select>
</div>

<!-- Content Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('content', 'Pentanyaan:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content']) !!}
</div>

<!-- Answers Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('answers', 'Answers:') !!}
    {!! Form::text('answers', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12 col-lg-12" style="margin-top: 30px">
    <h2 style="font-size: 30px">
        Pilihan
        <label style="color:grey;font-size:15px">
            (Tambahkan pilihan jawaban untuk pertanyaan anda)
        </label>
        <hr>
    </h2>
</div>
<div class="form-group col-sm-8">
    <button type="button" name="add" id="add" class="btn btn-primary">
        Tambah Pilihan
    </button>
</div>

<div id="dynamicTable" style="width: 100%">
</div>
@push('page_scripts')
    <script type="text/javascript">
        var i = 0;
        $("#add").click(function() {
            ++i;
            $("#dynamicTable").append(
                '<div    class="form-inline"    style="width: 100%;"    id="choice_text_option_' + i +
                '_id">    <div style="margin-top: 10px;" class="form-group col-sm-8"><input type="text" name="choice_text[' +
                i +
                ']" placeholder="Jawaban" name="choice_text[]" class="form-control col-sm-12" /></div>    <div style="margin-top: 10px;" class="form-check col-sm-2"><input class="form-check-input float-left"  name="is_correct[' +
                i +
                ']" id="is_correct[]" type="checkbox" /> <label class="form-check-label"  >Jawaban yang Benar</label></div>    <div style="margin-top: 10px;" class="form-group col-sm-2">        <button            type="button"            onclick="myFunction(' +
                i +
                ')"            name="max_attempts_count"            class="btn btn-danger float-left form-control"        >            <i class="nav-icon fas fa-trash"></i>        </button>    </div></div>'
            );
            console.log("ini add button");
        });

        myFunction = (id) => {
            // var id = "choice_text_option_" + id + "_id";
            var data = "choice_text_option_" + String(id) + "_id";
            console.log("ini id : ", data);
            var myobj = document.getElementById(data);
            // var myobj = document.getElementById('id');
            if (myobj !== null) {
                // $('#choice_text_option_1_id').remove();
                myobj.remove();
                // myobj.parentNode.removeChild(myobj);
                console.log("object ku :", myobj);
            }
            // myobj.remove();
        }

        // $(document).on('click', '.remove-tr', function() {

        //     $(this).parents('#choice_text').remove();

        // });

    </script>

    <script>
        var konten = document.getElementById("content");
        CKEDITOR.replace(konten, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;

    </script>
@endpush
