<div class="card mb-3">
  <a href="{{ route('spots.show', $spot->id) }}">
    <div class="card-body row">
      <div class="col-12 col-lg-4">
        @php
          $images = $spot->image
        @endphp
        <div class="new_spot my-auto">
          @if (app()->isLocal())
            <img class="new_spot__img" src="{{ asset('storage/'.$images[0] )}}" alt="">
          @else
            <img class="new_spot__img" src="{{ $images[0] }}" alt="">
          @endif
        </div>
      </div>
      <div class="col-12 col-lg-8 pt-3">
        <h5>{{ $spot->address}}</h5>
        <p>{{$spot->created_at}}</p>
        <div class="review mt-3">
          <p>{{ $spot->review}}</p>
        </div>
        <div class="likes">
          @if (isset($spot->count_likes))
            <i class="fas fa-heart"></i> x{{ $spot->count_likes }}
          @else
            <i class="fas fa-heart"></i> x{{ $spot->likes_count }}
          @endif
        </div>
        <div class="tags">
          @foreach($spot->tags as $tag)
            @if($loop->first)
              <div class="card-body pt-0 pb-4 pl-3">
                <div class="card-text line-height">
            @endif
                  <span data-url="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted JS_Click_TransitionToTagPage">
                    {{ $tag->hashtag }}
                  </span>
            @if($loop->last)
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </div>
    </div> 
  </a>
</div>