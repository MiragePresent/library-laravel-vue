<template>
    <div>
        <notifications group="messages" />
        <book-form/>
        <v-data-table
                :headers="headers"
                :items="books"
                :rows-per-page-items="pagination"
                class="elevation-1"
        >
            <template
                slot="items"
                slot-scope="{ item }"
            >
                <book-row :book="item"/>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    import {
        mapGetters,
        mapActions
    } from 'vuex';
    import BookRow from './BookRow';
    import BookForm from './BookForm';

    export default {
        components: {
            BookRow,
            BookForm,
        },
        data() {
            return {
                headers: [
                    {
                        text: 'Title',
                        sortable: true,
                        value: 'title',
                        align: 'left',
                    }, {
                        text: 'Author',
                        sortable: true,
                        value: 'author_id',
                        align: 'left',
                    }, {
                        text: 'Genre',
                        sortable: true,
                        value: 'genre_id',
                        align: 'left',
                    }, {
                        text: 'Language',
                        value: 'language',
                        align: 'left',
                    }, {
                        text: 'ISBN',
                        value: 'isbn',
                    }, {
                        text: 'Actions',
                        value: '',
                        sortable: false,
                    }
                ],
                pagination: [
                    10,
                    20,
                    50,
                    {text:'All', value:-1}
                ],
            }
        },
        computed: {
            ...mapGetters('book', ['books']),
        },
        methods: {
            ...mapActions('book', [
                'fetchBooks',
                'fetchAuthors',
                'fetchGenres',
                'fetchLanguages',
            ]),
        },
        created () {
            this.fetchBooks();
            this.fetchAuthors();
            this.fetchGenres();
            this.fetchLanguages();
        },
    }
</script>

<style scoped>

</style>