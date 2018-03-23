<template>
<tr>
    <td>{{size.id}}</td>
    <td>
        <input type="text" 
        v-model="editForm.size_name" 
        class="form-control" v-if="edit" 
        @keyup.enter="updateSize(size, editForm)">
        <span>{{size.size_name}}</span>
    </td>
    <td>{{size.created_at}}</td>
    <td>{{size.updated_at}}</td>
    <td>
        <button @click="editSize" type="button" class="btn btn-info" 
            v-if="!edit">
        Edit</button>
        <button @click="cancelSize" type="button" class="btn btn-default" 
            v-if="edit">
        Cancel</button>
    </td>
    <td>
        <button type="button" 
            class="btn btn-info" 
            @click="updateSize(size, editForm)" 
            v-if="edit">
        Update
        </button>
        <button type="button" 
            @click="$emit('delete-size', size)" 
            class="btn btn-danger" 
            v-if="!edit">Delete</button>
    </td>
</tr>
</template>

<script>
export default {
    props: ['size'],
    data() {
        return {
            sizes: '',
            edit: false,
            editForm: {
                size_name: '',
            }
        }
    },

    methods: {
        editSize() {
            this.edit = true;
            this.editForm.size_name = this.size.size_name;
            axios.get("admin/sizes").then(response => {

                this.sizes = response.data.sizes;
            });
        },
        cancelSize() {
            this.edit = false;
            this.editForm.size_name = '';
        },

        updateSize(oldSize, newSize) {
            axios.patch("admin/sizes/" + oldSize.id, newSize).then(response => {
                this.$emit('update-size');
                this.cancelSize();
            })
        },
        deleteSize(oldColor, newColor) {
            axios.patch("admin/sizes/" + oldSize.id, newSize).then(response => {
                this.$emit('delete-size');
                this.cancelSize();
            })
        }
    }
}
</script>
