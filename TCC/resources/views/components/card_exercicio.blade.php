<!-- <div class="quiz-option">
                            <input type="radio" name="letra_respondida" value="{{$letra}}" id="{{$option}}" class="{{$correta}}">
                            <label for="{{$option}}"><span>{{$letra}}</span></label>
                            <span>{{$value}}</span>
                            @if(isset($question))
            <div class="question">
                {{$question}}
            </div>
        @endif
</div>  -->

<!-- CARD ANTIGO ///////////////////////////////////////////////// -->
<!-- <div class="quiz-option">
    <input type="radio" name="letra_respondida" value="{{$letra}}" id="{{$option}}" class="{{$correta}}" {{$style}}>
    <label for="{{$option}}" {{$style_span}}><span>{{$letra}}</span></label>
    <span >{{$value}}</span>
        <div class="question">
          
        </div>
</div> -->
<!-- ESSE AQUI É O NOVO CARD /////////////////////////////////// -->

<label class="radio-container">
                    <input type="radio" name="letra_respondida" value="{{$letra}}" id="{{$option}}" class="{{$correta}}" {{$style}}>
                    <span class="radio-checkmark" {{$style_span}}>{{$letra}}</span> 
                    <p {{$option}}>{{$value}}</p>
                    <!-- aqui vc vai ter q criar um if para só aparecer a tag img quando for ter uma imagem na alternativa, abraços, fique com Deus<img
                        src="bota o seu elemento q vai puxar as imagens" alt="imagem_homepage" width="25%"> -->
    </label>


     