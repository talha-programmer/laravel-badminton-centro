{{--Header Image--}}
<div class="container-fluid">
    <div class="row cover-image" style="height: 60vh;">
        <div class="d-flex header-overlay w-100 h-100">
            <div class="my-auto mx-auto text-center">
                <span class="display-4  text-white">The Badminton Centro<br></span>
                <span class="font-italic text-white" style="font-size: 2rem">{{ $page_name }}</span>
            </div>
        </div>
    </div>
</div>


<style>
    @push('style_tag')
        .cover-image {
        background-image: url({{ asset('images/HomePageCoverImage.jpg') }});
        background-repeat: no-repeat;
        background-size: cover;
        background-position-y: center;
    }

    .header-overlay {
        background-color: rgba(31, 31, 31, 0.4);
    }


    @endpush
</style>
