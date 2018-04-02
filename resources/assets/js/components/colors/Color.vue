<template>
<tr>
    <td>{{item.id}}</td>
    <td>
        <input type="text" v-model="editForm.color_name" @keyup.enter="updateColor(item, editForm)" class="form-control" v-if="edit">
        <span>{{item.color_name}}</span>
    </td>
    <td>{{item.created_at}}</td>
    <td>{{item.updated_at}}</td>
    <td>
        <button @click="editColor" type="button" class="btn btn-info" 
            v-if="!edit">
        Edit</button>
        <button @click="cancelColor" type="button" class="btn btn-default" 
            v-if="edit">
        Cancel</button>
    </td>
    <td>
        <button type="button" 
            class="btn btn-info" 
            @click="updateColor(item, editForm)" 
            v-if="edit">
        Update
        </button>
        <button type="button" 
            @click="$emit('delete-color', item)" 
            class="btn btn-danger" 
            v-if="!edit">Delete</button>
    </td>
</tr>
</template>

<script>
export default {
    props: ['item'],
    data() {

        return {
            colors: '',
            edit: false,
            editForm: {
                color_name: '',
            }
        }

    },
    methods: {
        editColor() {
            this.edit = true;
            this.editForm.color_name = this.item.color_name;
            axios.get("admin/colors").then(response => {

                this.colors = response.data.colors;
            });
        },
        cancelColor() {
            this.edit = false;
            this.editForm.color_name = '';
        },

        updateColor(oldColor, newColor) {
            axios.patch("admin/colors/" + oldColor.id, newColor).then(response => {
                console.log(response);
                if (response.data.fail) {
                    toastr.warning(response.data.fail);
                } else {
                    this.$emit('update-color');
                    toastr.success('successfully');
                    this.cancelColor();
                }
            })
        },
        deleteColor(oldColor, newColor) {
            axios.patch("admin/colors/" + oldColor.id, newColor).then(response => {
                this.$emit('delete-color');
                this.cancelColor();
            })
        }
    }
}
</script>
