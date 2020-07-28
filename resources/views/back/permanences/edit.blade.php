@extends('layouts.layoutBack')

@section('css')
    <style>
        /*.btn:not(.btn-link):not(.btn-circle) {
            box-shadow: 0 0px 0px rgba(0,0,0,.16), 0 0px 0px rgba(0,0,0,.12);
        }
        [type="checkbox"].filled-in:checked + label:after {
            border: 2px solid #8BC34A;
            background-color: #8BC34A;
        }
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 500px;
        }*/
        .well-sm {
            cursor: pointer; 
        }
        .well-left {
            background: #9F1843;
            color: #fff;
        }
        .well-right {
            background: #918f90;
        }

        /* Style for sortable lists */ 
        .span4 {
            /*width: 300px; */
        }
        .row-fluid .span4 {
            /*width: 31.915%;
            *width: 31.862%; */
        }
        input.span4,
        textarea.span4,
        .uneditable-input.span4 {
            /*width: 290px; */
        }
        table .span4 {
            float: none;
            /*width: 284px;*/
            margin-left: 0; 
        }
        ol.nested_with_switch li, ol.simple_with_animation li, ol.serialization li, ol.default li {
            cursor: pointer; 
        }
        ol.vertical {
            margin: 0 0 9px 0;
            min-height: 10px; 
        }
        ol.vertical li {
            display: block;
            margin: 5px;
            padding: 5px;
            border: 1px solid #cccccc;
            color: #0088cc;
            background: #eeeeee; 
        }
        ol.vertical li.placeholder {
            position: relative;
            margin: 0;
            padding: 0;
            border: none; 
        }
        ol.vertical li.placeholder:before {
            position: absolute;
            content: "";
            width: 0;
            height: 0;
            margin-top: -5px;
            left: -5px;
            top: -4px;
            border: 5px solid transparent;
            border-left-color: red;
            border-right: none; 
        }
        ol.nav .divider-vertical {
            cursor: default; 
        }
        ol.vertical li {
            display: block;
            margin: 5px;
            padding: 5px;
            border: 1px solid #cccccc;
            background: #9F1843;
            color: #fff;
        }
        li {
            line-height: 22px;
        }
        ol li.highlight {
            background: #333333;
            color: #fff;
        }
        ol.nested_with_switch li, ol.simple_with_animation li, ol.serialization li, ol.default li {
            cursor: pointer; 
        }
        ol {
            list-style-type: none; 
        }
        ol i.icon-move {
            cursor: pointer; 
        }
        ol li.highlight i.icon-move {
            background-image: url("../img/glyphicons-halflings-white.png"); 
        }
        .dragged {
            position: absolute;
            top: 0;
            opacity: 0.5;
            z-index: 2000; 
        }
        ol.nav li.dragged {
            background-color: #2c2c2c; 
        }
    </style>
@endsection

@section('content')
    {{-- <div class="row clearfix"> --}}
        {{-- <div class="alert alert-success alert-dismissable hidden" id="alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Attribution des permanences modifiée avec succès.
        </div> --}}
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-calendar-check-o"></i>  <a href="{{ route('back.permanences-attribution.index') }}">Attribution permanences</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Editer
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3 class="text-center">Modifier manuellement l'attribution des permanences</h3>
            <p class="text-center"><i class="fa fa-exclamation-triangle"></i><small> Attention, en cas de modification, l'attribution des permanences perd de fait sa nature aléatoire </small><i class="fa fa-exclamation-triangle"></i></p>
            <p class="text-center">{{ $calendar['week' . $week] }} {{ $year }}.</p>
            @if ($errors->any())        
                <div class='flash alert alert-danger alert-dismissable'> 
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
                    @foreach ( $errors->all() as $error )               
                        <p>{{ $error }}</p>         
                    @endforeach     
                </div>  
            @endif
        </div>
    </div>
    <div class="row">
            {{-- <div class="col-md-10 col-md-offset-1">
                
                <div id="warning" class="hidden">
                    <p class="text-center" style="color: red;">Attention, pas plus de 4 avocats dans la liste des avocats de permanences</p>
                </div>

                <div class="col-md-4" style="background: #eeeeee;">
                    <h4 class="text-center">Avocats de permanence <div class="badge" id="left_length"></div></h4>
                    <div class="lawyers_list left" style="padding: 20px 0px;">
                        @foreach ($lawyersWithAttribution as $a)
                            <div class="well well-sm well-left lawyer" id="{{$a->id}}" value="{{ $a->id }}">{{ $a->firstname }} {{ $a->lastname }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-8" style="height: 400px; overflow-y: auto;">
                    <h4 class="text-center">Avocats disponibles <div class="badge" id="right_length"></badge></h4>
                    <div class="lawyers_list right" style="padding: 20px 0px;">
                        @foreach ($lawyersWithoutAttribution as $b)
                            <div class="well well-sm well-right lawyer col-md-4" id="{{$b->id}}" value="{{ $b->id }}">{{ $b->firstname }} {{ $b->lastname }}</div>
                        @endforeach
                    </div>
                </div>

            </div> --}}

            <div class="col-md-10 col-md-offset-1">
                <div id="warning" class="hidden">
                    <p class="text-center" style="color: red;">Attention, pas plus de 4 avocats dans la liste des avocats de permanences</p>
                </div>
                <div class="col-md-6 span4" style="background: #efefef; padding-top: 20px; padding-right: 50px;">
                    <h4 class="text-center">Avocats de permanence <div class="badge" id="left_length"></div></h4>
                    <ol class="simple_with_animation vertical left">
                        @foreach ($lawyersWithAttribution as $a)
                            <li class="" value="{{ $a->id }}">{{ $a->firstname }} {{ $a->lastname }}</li>
                        @endforeach
                    {{-- <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                    <li>Item 4</li>
                    <li>Item 5</li>
                    <li>Item 6</li> --}}
                    </ol>
                </div>
                <div class="col-md-6 span4" style="background: #d6d6d6; padding-top: 20px; padding-right: 50px; height: 400px; overflow-y: auto;">
                    <h4 class="text-center">Avocats disponibles <div class="badge" id="right_length"></badge></h4>
                    <ol class="simple_with_animation vertical right">
                        @foreach ($lawyersWithoutAttribution as $b)
                            <li class="highlight" value="{{ $b->id }}">{{ $b->firstname }} {{ $b->lastname }}</li>
                        @endforeach
                    {{-- <li class='highlight'>Item A</li>
                    <li class='highlight'>Item B</li>
                    <li class='highlight'>Item C</li>
                    <li class='highlight'>Item D</li>
                    <li class='highlight'>Item E</li>
                    <li class='highlight'>Item F</li> --}}
                    </ol>
                </div>
            </div><!-- ./col-md-10 col-md-offset-1 -->
            
            <div class="col-md-12">
                <br />
                <div class="text-center">
                    {{-- {!! Form::submit('Modifier les attributions de permanence', array('class'=>'btn btn-primary', 'id' => 'editAttribution')) !!} --}}
                    <button class="btn btn-primary" id="editAttribution">Modifier les attributions de permanence</button>
                    <a href="{{ route('back.permanences-attribution.index') }}" class="btn btn-default">Annuler</a>
                </div>
            </div>
        {{-- {!! Form::close() !!} --}}
    </div><!-- ./row -->
    
@endsection

@section('scripts')

    <script src="{{ asset('js/jquery-sortable.js') }}"></script>

    <script>
        // Calculate # items per column
        $(document).ready(function () {
            // var left_length = $('.left').children().length;
            // var right_length = $('.right').children().length;
            var left_length = $('ol.left li').length;
            var right_length = $('ol.right li').length;
            // console.log(left1_length);
            // console.log(right1_length);
            $('#left_length').html(left_length);
            $('#right_length').html(right_length);
        })
    </script>
    <script>
        // Compute both lists
        // $(".lawyers_list").sortable({
        //   group: 'lawyers_list',
        //   pullPlaceholder: false,
        //   vertical: false,
        //   containerSelector: "lawyers_list",
        //   itemSelector: ".lawyer",
        //   // animation on drop
        //   isValidTarget: function  ($item, container) {
        //     $('#warning').removeClass();
        //     $('#warning').addClass('hidden');
        //     // console.log($(".left>li").length);
        //     if ($('.left>.lawyer').length >= 4) {
        //         $('#warning').removeClass('hidden');
        //     }
        //     if (container.target[0].className === 'lawyers_list left' && container.target[0].childElementCount >= 4) {
        //         return false;
        //     } else {
        //         if (container.target[0].className === 'lawyers_list left') {
        //             $item.removeClass('col-md-4');
        //         } else {
        //             $item.addClass('col-md-4');
        //         }
        //         return true;
        //     }
        //   },
        //   onDrop: function  ($item, container, _super) {
        //     console.log($('.left').children().length);
        //     var left_length = $('.left').children().length;
        //     var right_length = $('.right').children().length;
        //     $('#left_length').html(left_length);
        //     $('#right_length').html(right_length);
        //   },
        //   // set $item relative to cursor position
        //   onDragStart: function ($item, container, _super) {
        //     // console.log('onDragStart');
        //   },
        //   onDrag: function ($item, position) {
        //     // console.log('onDrag');
        //   },
        // });
    </script>

    <script>
        var adjustment;

        $("ol.simple_with_animation").sortable({
          group: 'simple_with_animation',
          pullPlaceholder: false,
          isValidTarget: function  ($item, container) {
            $('#warning').removeClass();
            $('#warning').addClass('hidden');
            // return false;
            // console.log($('ol#left li').length);
            // console.log(container);
            // console.log(container.target[0].className);
            // console.log($item);
            if (container.target[0].className === 'simple_with_animation vertical left' && container.items.length >= 4) {
                $('#warning').removeClass('hidden');
                console.log(container.items.length);
                return false;
            }
            // return true;
            // if ($('ol#left li').length >= 4) {
            //     $('#warning').removeClass('hidden');
            //     return false;
            // }
            return true;
            // if (container.target[0].className === 'lawyers_list left' && container.target[0].childElementCount >= 4) {
            //     return false;
            // } else {
            //     if (container.target[0].className === 'lawyers_list left') {
            //         $item.removeClass('col-md-4');
            //     } else {
            //         $item.addClass('col-md-4');
            //     }
            //     return true;
            // }
          },
          // animation on drop
          onDrop: function  ($item, container, _super) {
            console.log('onDrop');
            var left_length = $('ol.left li').length;
            var right_length = $('ol.right li').length;
            $('#left_length').html(left_length);
            $('#right_length').html(right_length);

            var $clonedItem = $('<li/>').css({height: 0});
            $item.before($clonedItem);
            $clonedItem.animate({'height': $item.height()});

            $item.animate($clonedItem.position(), function  () {
              $clonedItem.detach();
              _super($item, container);
            });
            // console.log(container);
            // console.log(container.items.length);
            // var left_length = container.items.length;
            // var right_length = container.items.length;
            // $('#left_length').html(left_length);
            // $('#right_length').html(right_length);
          },

          // set $item relative to cursor position
          onDragStart: function ($item, container, _super) {
            var offset = $item.offset(),
                pointer = container.rootGroup.pointer;

            adjustment = {
              left: pointer.left - offset.left,
              top: pointer.top - offset.top
            };

            _super($item, container);
          },
          onDrag: function ($item, position) {
            $item.css({
              left: position.left - adjustment.left,
              top: position.top - adjustment.top
            });
          },
          // afterMove: function ($placeholder, container, $closestItemOrContainer) {
          //   console.log('afterMove');
          //   // var left_length = $('ol#left li').length;
          //   // var right_length = $('ol#right li').length;
          //   // $('#left_length').html(left_length);
          //   // $('#right_length').html(right_length);
          // }
        });
    </script>

    <script>
        // Edit the lists
        $('#editAttribution').click(function (e) {
            console.log('click');
            // console.log($('lawyers_list left'));
            var year = <?php echo $year; ?>;
            var month = <?php echo $month; ?>;
            var week = <?php echo $week; ?>;
            var ids = [];
            $('.left').children().each(function( index ) {
                // console.log( index + ": " + $( this ).text() );
                console.log($(this).attr('value'));
                ids.push($(this).attr('value'));
            });
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'PATCH',
                url: "{{ URL::route('back.permanences-attribution.update', ['id' => 1]) }}",
                data: {
                    'year': year,
                    'month': month,
                    'week': week,
                    'ids': ids
                },
                success: function(data) {
                    console.log('success');
                    console.log(data);
                    toastr.success('Attribution des permanences modifiée avec succès', 'Succès');
                    $('#alert').removeClass("hidden");
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log(textStatus);
                    console.log(errorThrown);
                    toastr.error('Erreur dans la nouvelle attribution des permanences', 'Erreur');
                },
            });
        })
    </script>

@endsection