<template>
<div>
    <form v-on:submit.prevent="createColor" method="post" action="">
        <div class="form-group">
            <label for="">Color</label>
            <input type="text" class="form-control" v-model="item.color_name">
            <span></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Create New Product">
        </div>
    </form>
    <table class=" table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>STT</th>
                <th>Color</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <color v-for="item in items" 
                :key="item.id" 
                v-bind:item = "item"
                @update-color="getvueproduct"
                @delete-color="deleteColor">
            </color>
        </tbody>
    </table>
    <div v-bind:style="styleObject">
        <nav>
            <ul class="pagination">
                <li v-if="pagination.current_page > 1">
                    <a href="#" aria-label="Previous"
                        @click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li v-for="page of pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '']">
                    <a href="#"
                        @click.prevent="changePage(page)">{{ page }}</a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page">
                    <a href="#" aria-label="Next"
                        @click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</template>

<script type="text/javascript">
import color from "./Color.vue";


export default {
    components: {
        color
    },
    data() {
        return {
            items: [],
            item: {
                id: '',
                color_name: '',
                created_at: '',
                updated_at: ''
            },
            pagination: {
                total: 0,
                per_page: 2,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4,
            styleObject: {
                textAlign: 'center'
            }

        };
    },
    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.current_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    created: function () {
        this.getvueproduct(this.pagination.current_page);
    },
    methods: {
        getvueproduct: function (page) {
            axios.get('/admin/colors?page=' + page).then((response) => {
                this.items = response.data.data.data;
                this.pagination = response.data.pagination;

            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getvueproduct(page);
        },

        createColor() {
            axios.post('admin/colors/', this.item).then(response => {
                if (response.data.fail) {
                    toastr.warning(response.data.fail);
                } else {
                    this.items.unshift(response.data.color);
                    toastr.success('successfully');
                    this.item = {
                        color_name: '',
                        id: '',
                        created_at: '',
                        updated_at: ''
                    }
                    if (this.errors) {
                        this.errors = [];
                    }
                }
                
            }, response => {
                this.errors = response.data.errors;
            });
        },
        deleteColor(item) {
            axios.delete("admin/colors/" + item.id).then(response => {
                let index = this.items.indexOf(item);
                if (confirm('do you really want to delete this category?')) {
                    this.items.splice(index, 1);
                }

            })
        },
    }

}
</script>
