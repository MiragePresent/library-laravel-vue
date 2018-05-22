<template>
    <tr>
        <td>{{ book.title }}</td>
        <td class="text-xs-right">{{ author }}</td>
        <td class="text-xs-right">{{ genre }}</td>
        <td class="text-xs-right">{{ language }}</td>
        <td class="text-xs-right">{{ book.isbn }}</td>
        <td class="justify-center layout px-0">
            <v-btn icon class="mx-0" @click="edit">
                <v-icon color="teal">edit</v-icon>
            </v-btn>
            <v-btn icon class="mx-0" @click="remove">
                <v-icon color="pink">delete</v-icon>
            </v-btn>
        </td>
    </tr>
</template>

<script>
    import {
        mapGetters,
        mapActions,
    } from 'vuex';
    export default {
        props: {
            book: {
                type: Object,
                required: true,
                default: {
                    title: '',
                    author_id: '',
                    genre_id: '',
                    lang: '',
                    isbn: '',
                }
            },
        },
        computed: {
            ...mapGetters('book', [
                'authors',
                'genres',
                'languages',
                'defaultBook',
                'responseCode',
            ]),
            author() {
                return this.authors.find(a => a.id === this.book.author_id).name || '';
            },
            genre() {
                return this.genres.find(g => g.id === this.book.genre_id).title || '';
            },
            language() {
                return this.languages.find(l => l.code === this.book.lang).title || '';
            },
        },
        methods: {
            ...mapActions('book', [
                'setEditing',
                'openForm',
                'destroy',
                'clearRequestStatus',
            ]),
            edit() {
               this.setEditing(this.book);
               this.openForm();
            },
            remove() {
                return confirm('Do you really want to delete this book?') && this.destroy(this.book.id);
            },
            processResponse() {
                if (this.responseCode === 204) {
                    this.$notify({
                        group: 'messages',
                        title: 'Success!',
                        text: 'Book has been removed',
                    });
                    this.clearRequestStatus();
                }
            }
        },
        watch: {
            responseCode: 'processResponse',
        }
    }
</script>

<style scoped>

</style>