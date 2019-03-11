<form class="book-search-form">

    <div class="booksearch-col-6">
        <label>Book:</label>
        <input type="text" name="bookname">
    </div>

    <div class="booksearch-col-6">
        <label>Author:</label>
        <?php $authors=get_terms('authors'); ?>
        <select name="authors">
        <option value="">Select..</option>
        <?php   
        foreach ($authors as $key => $author) {
            echo "<option value='".$author->term_id."'>".$author->name."</option>";
        }
         ?>
        </select>
    </div>
    <div class="clearfix">   </div>

    <div class="booksearch-col-6">
        <label>Publisher:</label>
        <?php $publishers=get_terms('publishers'); ?>
        <select name="publisher">
        <option value="">Select..</option>
        <?php   
        foreach ($publishers as $key => $publisher) {
            echo "<option value='".$publisher->term_id."'>".$publisher->name."</option>";
        }
         ?>
        </select>
    </div>

    <div class="booksearch-col-6 ">
        <label>Rating:</label>
        <select name="rating">
        <?php   
        for($i=1;$i<=5;$i++){
        echo "<option value='".$i."'>".$i."</option>";
        }
         ?>
        </select>
    </div>
        <div class="clearfix">   </div>


    <div class="booksearch-col-6">

        <label for="amount">Price</label>
        <div id="slider-range"></div>      
          <input type="text" class="book-price min-price" name="min_price" readonly style="border:0; color:#f6931f; font-weight:bold;">-
          <input type="text" class="book-price max-price" name="max_price" readonly style="border:0; color:#f6931f; font-weight:bold;">


    </div>

    <input type="hidden" name='admin-ajax' class="admin-ajax" value="<?php echo ADMIN_AJAX_URL ?>"  >
    <input type="submit" name="book-search-button" class="book-search-button" value="book-search-button">
<div class="search-result">
    
</div>
</form>
