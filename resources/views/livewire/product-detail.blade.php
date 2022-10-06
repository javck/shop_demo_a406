<div class="single_product_text text-center">
    <h3>{{ $item->title }}</h3>
    <p>
        Seamlessly empower fully researched growth strategies and interoperable internal or “organic” sources. Credibly innovate granular internal or “organic” sources whereas high standards in web-readiness. Credibly innovate granular internal or organic sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences. Dramatically synthesize integrated schemas. with optimal networks.
    </p>
    <div class="card_area">
        <div class="product_count_area">
            <p>數量</p>
            <div class="product_count d-inline-block">
                <span class="product_count_item inumber-decrement" wire:click="minus"> <i class="ti-minus"></i></span>
                <input class="product_count_item input-number" type="text" wire:model="quantity" min="1" max="99">
                <span class="product_count_item number-increment" wire:click="plus"> <i class="ti-plus"></i></span>
            </div>
            <p>${{ $total }}</p>
        </div>
    <div class="add_to_cart">
        <a href="{{ url('/addcart/' . $item->id .'?quantity=' . $quantity) }}" class="btn_3">加入購物車</a>
    </div>
    </div>
</div>
