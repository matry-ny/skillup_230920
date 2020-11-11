<form action="" method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
    </div>
    <div>
        <label for="parent_category_id">Parent Category</label>
        <select name="parent_category_id" id="parent_category_id">
            <option value="">--</option>
            <?php foreach (getCategories() as  $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" value="Save">
</form>