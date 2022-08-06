<template>
    <label for="name" class="col-sm-4 col-form-label">
        Category Name <i class="text-danger">*</i>
    </label>
    <div class="col-sm-6">
        <input v-model="form.name" class="form-control" name="name" id="name" type="text" placeholder="Category Name"
            tabindex="1" required>
        <HasError :form="form" field="name" />
    </div>
</template>

<script>
export default {

}
</script>