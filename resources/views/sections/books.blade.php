<div class="card-deck">
    @foreach ($books as $book)
    <div class="card">
        <div class="card-body">
          <h5 class="card-title"> {{ $book->id }}. {{  $book->name }}</h5>
          <p class="card-text"> Authors: 
            @foreach ($book->authors as $author)
              <i>{{ $author->name }} @if(!$loop->last) , @endif</i>
            @endforeach
          </p>
          <p class="card-text"> Publishers: 
            @foreach ($book->publishers as $publisher)
            <i>{{ $publisher->name }} @if(!$loop->last) , @endif</i>
            @endforeach 
          </p>
        </div>
      </div>
    @endforeach
</div>
<br>
{!! $books->links() !!}