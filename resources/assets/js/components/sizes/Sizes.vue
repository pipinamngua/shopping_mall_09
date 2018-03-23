<template>
<div>
    <form v-on:submit.prevent="createSize" method="post" action="">
        <div class="form-group">
            <label for=""></label>
            <input type="text" class="form-control" v-model="size.size_name">
        </div>
        <div class="form-group">
            <label for=""></label>
            <input type="submit" class="btn btn-primary" value="Create New Size">
        </div>
    </form>
    <table class=" table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th>STT</th>
                <th>Size</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <size v-for="size in sizes" 
                :key="size.id" 
                v-bind:size = "size"
                @update-size="getVueSize"
                @delete-size="deleteSize">
            </size>
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

<script>
import size from "./Size.vue";
export default {
    components: {
        size
    },
    data() {
        return {
            sizes: [],
            size: {
                id: '',
                size_name: '',
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
        this.getVueSize(this.pagination.current_page);
    },
    methods: {
        getVueSize: function (page) {
            axios.get('/admin/sizes?page=' + page).then((response) => {
                this.sizes = response.data.data.data;
                this.pagination = response.data.pagination;

            });
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.getVueSize(page);
        },

        createSize() {
            axios.post('admin/sizes/', this.size).then(response => {
                this.sizes.unshift(response.data);
                this.size = {
                    size_name: '',
                    id: '',
                    created_at: '',
                    updated_at: ''
                }
                if (this.errors) {
                    this.errors = [];
                }
            }, response => {
                this.errors = response.data.errors;
            });
        },
        deleteSize(size) {
            axios.delete("admin/sizes/" + size.id).then(response => {
                let index = this.sizes.indexOf(size);
                if (confirm('do you really want to delete this size?')) {
                    this.sizes.splice(index, 1);
                    console.log(response.data);
                }

            })
        },
    }
}
</script>
