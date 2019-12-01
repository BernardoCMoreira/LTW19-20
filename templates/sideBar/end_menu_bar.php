        <br>
        <br>
        <label for="price">Max.Price Per Day</label><br>
        <input type="number" id="price" name="price"
            min= <?= $minPrice ?>
            max= <?= $maxPrice ?>
            value=<?= $price ?>>
        <input type="submit" value="Search">
    </form>
</div>