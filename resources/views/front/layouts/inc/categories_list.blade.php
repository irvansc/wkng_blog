<ul class="widget-list">
    @foreach ( categories() as $item)
    <li><a href="{{ route('category_post',$item->slug) }}">{{$item->subcategory_name}}
            <span class="ml-auto">({{$item->posts->count()}})</span></a>
    </li>

    @endforeach
</ul>
