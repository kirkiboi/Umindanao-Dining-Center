<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu & Pricing System</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/menu-pricing/add.product.css'])
</head>
<body>
    <div class="parent-container">
        <div class="sidebar-container">
            <div class="nav-logo">
                <img src="{{ asset('photos/UMDiningcenter.png') }}" alt="UM Dining Center Logo" class ="dashboard-logoDiningCenter">
            </div>
            <div class="nav-general">
                <h1>General</h1>
            </div>
            <div class="navigation-container">
                <nav class = "navigation">
                    <ul class = "navigation-ul">
                        <li><a href="">Dashboard</a></li>
                        <li><a href="">Sales</a></li>
                        <li><a href="">Inventory</a></li>
                        <li class = "menu-pricing-navigation"><a href="{{ url('/menu-pricing')}}">Menu and Pricing</a></li>
                        <li><a href="">Kitchen Production</a></li>
                        <li><a href="">Cost and Variance Analysis</a></li>
                    </ul>
                    <button>Logout</button>
                </nav>
            </div>
        </div>
        <div class="add-product-container">
            <div class="add-product-sub-container">
                <div class="h1-container">
                    <h1>
                        Edit Product
                    </h1>
                </div>
                <div class="form-container">
                    <form method="post" action="{{route('update-product', $product->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="product-name-div">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" value="{{ old('price') }}" class="@error('name') input-error @enderror">
                             @error('name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="product-category-segment">
                            <div class="product-category-segment-h1">
                                <span>Item Category</span>
                            </div>
                           <div class="product-category-segment-inputs">
                                <input type="radio" id="category1" name="category" value="Drinks" checked>
                                <label for="category1">Drinks</label>
                                <input type="radio" id="category2" name="category" value="Snacks">
                                <label for="category2">Snacks</label>
                                <input type="radio" id="category3" name="category" value="Meals">
                                <label for="category3">Meals</label>
                            </div>
                        </div>
                        <div class="product-price-div">
                            <label for="price">Price</label>
                            <input type="text" name ="price" placeholder="PHP 00.00" value="{{ old('price') }}" class="@error('price') input-error @enderror">
                            @error('price')
                                <span class="error-message">{{ $message }}</span>
                            @enderror    
                        </div>
                        <div class="image-uploader">
                            <label class="upload-label">Image</label>
                            <label class="upload-area">
                                <div class="upload-text">Click or drag file to this area to upload</div>
                                <input type="file" accept="image/*">
                            </label>
                        </div>
                        <div class="add-product-buttons-container">
                            <button class="cancel-button" type="button" onclick="window.location='{{route('menu-pricing')}}'">
                                Cancel
                            </button>
                            <input type="submit" value="Update" id="submit-button">
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
</body>
</html>