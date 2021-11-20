@extends('layouts.app')

@section('styles')
    <style>
        .not-unique-text {
            background-color: red;
            color: #FFFFFF;
            color: #adcad1;
            padding: 0px 2px;
        }

        .keyword {
            background-color: green;
            color: #FFFFFF;
            padding: 0px 2px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Проект') }}: <b>{{ $project->name }}</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('projects.index') }}" class="btn btn-primary"><i class="fas fa-reply"></i></a>
                    <a href="{{ route('projects.keywords.index', $project) }}" class="btn btn-primary">Ключевые слова</a>
                    <a href="{{ route('projects.sources.index', $project) }}" class="btn btn-primary">Источники текста</a>

                    <br/>
                    <br/>

                    <div class="row">
                        <label for="text" class="col-md-5 col-form-label text-md-left">Неиспользуемые ключи:</label>
                        <div class="col-md-7 pt-2">{{ $unusedKeywords }}</div>
                    </div>

                    <div class="row">
                        <label for="text" class="col-md-5 col-form-label text-md-left">{{ __('Выполнение по ключевым словам:') }}</label>
                        <div class="col-md-7 pt-2">{{ $keywordsCompletion }}</div>
                    </div>

                    <div class="d-flex">
                        <div class="p-2">Символов: <span id="text-symvols"></span></div>
                        <div class="p-2">Символов без пробелов: <span id="text-clear-symvols"></span></div>
                    </div>

                    <div class="d-flex flex-column">
                        <div style="padding: 8px 12px 0px 12px; width: fit-content; background-color: #adcad1;">
                            <label for="highlight-by-keys">Подсветка совпадений по ключам</label>
                            <input type="checkbox" id="highlight-by-keys"
                                @if ($project->highlight_keys > 0) checked @endif
                                style="margin-left: 6px;vertical-align: middle;">
                        </div>
                        <div style="margin-top: 2px; padding: 8px 12px 0px 12px; width: fit-content; background-color: #FFFF00;">
                            <label for="highlight-by-source">Подсветка совпадений по источникам</label>
                            <input type="checkbox" id="highlight-by-source"
                                @if ($project->highlight_source > 0) checked @endif
                                style="margin-left: 6px;vertical-align: middle;">
                        </div>
                    </div>

                    <br/>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-text-tab" data-toggle="tab"
                                href="#nav-text" role="tab" aria-controls="nav-text" aria-selected="true">{{ __('Ваш текст') }}</a>

                            @foreach ($project->sources as $source)
                                <a class="nav-item nav-link" id="nav-source-tab-{{ $source->id }}" data-toggle="tab"
                                href="#nav-source-{{ $source->id }}" role="tab" aria-controls="nav-source" aria-selected="false">{{ $source->name }}</a>
                            @endforeach
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-text" role="tabpanel" aria-labelledby="nav-text-tab">
                            <div class="mt-2">
                                <a href="#" id="find-synonims-btn">синонимы (alt + enter): <span id="selected-word"></span></a>
                            </div>

                            <form method="POST" action="{{ route('projects.text', $project) }}">
                                @csrf

                                <input type="hidden" id="highlight_keys" name="highlight_keys" value="{{ $project->highlight_keys }}" />
                                <input type="hidden" id="highlight_source" name="highlight_source" value="{{ $project->highlight_source }}" />

                                <div class="pt-2">
                                    <div class="w-100">
                                        <textarea id="text" name="text" cols="30" rows="20"
                                        class="form-control @error('text') is-invalid @enderror" autofocus autocomplete="false"
                                        >{{ old('text', $project->text) }}</textarea>

                                        @error('text')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <br/>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button id="store-text-btn" type="submit" class="btn btn-primary">
                                            {{ __('Сохранить (ctrl + enter)') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        @foreach ($project->sources as $source)
                            <div class="tab-pane fade" id="nav-source-{{ $source->id }}" role="tabpanel" aria-labelledby="nav-source-tab-{{ $source->id }}">
                                <div class="pt-2">
                                    <div class="w-100">
                                        <textarea cols="30" rows="20" class="form-control" readonly>{{ $source->text }}</textarea>

                                        {{-- не безопасно --}}
                                        {{-- @php echo str_replace("\n", '<br/>', $source->text); @endphp --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        const allKeywordsAsArray = @json($allKeywordsAsArray);
        const notUniqueWordsAsArray = @json($notUniqueWordsAsArray);

        const getSelectionText = function() {
            if (!window.getSelection) {
                return '';
            }

            let result = '';

            try {
                var textarea = $('#text').get(0);

                result = (textarea.selectionStart != textarea.selectionEnd )
                    ? textarea.value.substring(textarea.selectionStart, textarea.selectionEnd)
                    : '';
            } catch (e) {
                result = '';
            }

            // For IE
            if (document.selection && document.selection.type != 'Control') {
                result = document.selection.createRange().text;
            }

            if (result.length > 30) {
                return '';
            }

            return result;
        };

        $(document).ready(function() {
            let text = $('#text').val();

            $('#text-symvols').text(text.length);
            $('#text-clear-symvols').text(text.split(' ').join('').split("\n").join('').length);

            $("#text").keyup(function(e) {
                let text = $(this).val();

                $('#text-symvols').text(text.length);
                $('#text-clear-symvols').text(text.split(' ').join('').split("\n").join('').length);

                if ((e.keyCode || e.which) == 13) {
                    if (e.ctrlKey) {
                        $('#store-text-btn').click();
                    } else if (e.altKey) {
                        $('#find-synonims-btn').click();
                    }

                    return;
                }

                let word = getSelectionText();

                if (word != '') {
                    $('#selected-word').text(word.trim());
                }
            });

            $(document).on('mouseup', 'body', function(e) {
                let word = getSelectionText();

                if (word != '') {
                    $('#selected-word').text(word.trim());
                }
            });

            $('#find-synonims-btn').click(function(e) {
                e.preventDefault();

                let word = $('#selected-word').text().trim();

                if (word == '') {
                    return;
                }

                $.ajax({
                    method: "POST",
                    url: "{{ route('synonims.find') }}",
                    data: {
                        word: word
                    }
                })
                .done(function(msg) {
                    msg = JSON.parse(msg);

                    if (!msg.success) {
                        alert('Синонимы не найдены');
                    } else {
                        alert(msg.synonims);
                    }
                })
                .fail(function() {
                    alert( "error" );
                });
            });

            $("#highlight-by-keys").change(function(e) {
                let val = $(this).is(":checked") ? 1 : 0;

                $('#highlight_keys').val(val);
                $('#store-text-btn').click();
            });

            $("#highlight-by-source").change(function(e) {
                let val = $(this).is(":checked") ? 1 : 0;

                $('#highlight_source').val(val);
                $('#store-text-btn').click();
            });

            let highlightConfig = [];

            if (allKeywordsAsArray.length > 0) {
                highlightConfig.push({
                    color: '#adcad1',
                    words: allKeywordsAsArray
                });
            }

            if (notUniqueWordsAsArray.length > 0) {
                highlightConfig.push({
                    color: '#FFFF00',
                    words: notUniqueWordsAsArray
                });
            }

            if (highlightConfig.length > 0) {
                $('#text').highlightTextarea({words: highlightConfig});
            }
        });
    </script>
@endsection