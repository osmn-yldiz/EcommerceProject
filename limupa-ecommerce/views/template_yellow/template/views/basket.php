<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!--Shopping Cart Area Strat-->
<div class="Shopping-cart-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="li-product-remove">Sil</th>
                                <th class="li-product-thumbnail">Resim</th>
                                <th class="cart-product-name">Ürün</th>
                                <th class="li-product-price">Fiyat</th>
                                <th class="li-product-quantity">Miktar</th>
                                <th class="li-product-subtotal">Toplam Fiyat</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $odenecekTutar = 0;
                            $kdv = 0;
                            foreach ($BasketList as $Basket) {
                                ?>
                                <tr class="basket_<?php print $Basket['ID']; ?>">
                                    <td class="li-product-remove"><a href="javascript:void(0)"
                                                                     onclick="deleteProducts(<?php echo $Basket['ID']; ?>)"><i
                                                    class="fa fa-times"></i></a></td>
                                    <td class="li-product-thumbnail"><a href="#"><img
                                                    src="uploads/products/<?php echo $Basket['Images']; ?>" height="150"
                                                    alt="Li's Product Image"></a></td>
                                    <td class="li-product-name"><a href="#"><?php echo $Basket['Name']; ?></a></td>
                                    <td class="li-product-price"><span
                                                class="amount"><?php echo $Basket['Price']; ?> ₺</span></td>
                                    <td class="quantity">
                                        <label>Miktar</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" onchange="eksi()"
                                                   value="<?php echo $Basket['Quantity']; ?>" type="text">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </td>
                                    <td class="product-subtotal"><span
                                                class="amount"><?php echo MoneyFormat($Basket['Quantity'] * $Basket['Price']); ?> ₺</span>
                                    </td>
                                </tr>
                                <?php
                                $odenecekTutar += $Basket['Quantity'] * $Basket['Price'];
                                $kdv += (($Basket['Price'] * $Basket['Quantity']) * $Basket['KDV']) / 100;
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                           placeholder="Coupon code" type="text">
                                    <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                </div>
                                <div class="coupon2">
                                    <input class="button" name="update_cart" value="Update cart" type="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Toplam</h2>
                                <ul>
                                    <li>Mal Hizmet Toplam Tutarı <span><?php echo MoneyFormat($odenecekTutar - $kdv); ?> ₺</span>
                                    </li>
                                    <li>Hesaplanan KDV <span><?php echo MoneyFormat($kdv); ?> ₺</span></li>
                                    <li>Ödenecek Tutar <span><?php print MoneyFormat($odenecekTutar) ?> ₺</span></li>
                                </ul>
                                <a href="index.php?func=payment">Ödeme Yap</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Shopping Cart Area End-->
<script>
    function deleteProducts(ID) {
        $.post({
            url: "ajax/basket-delete.php",
            data: 'ID=' + ID,
            cache: false,
            success: function (ajaxAnswer) {
                if (ajaxAnswer == 1) {
                    console.log(ID);
                    $(".basket_" + ID).remove();
                    location.reload();
                } else {
                    alert("Silme işlemi başarısız.");
                }
            }
        });

    }
</script>