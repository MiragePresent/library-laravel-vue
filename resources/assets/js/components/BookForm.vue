<template>
    <v-dialog
        id="dialog"
        :value="formVisibility"
        max-width="500px"
        @input="changeVisibility"
    >
        <v-btn
            icon
            color="primary"
            dark slot="activator"
            class="mb-2"
            @click="reset"
        >
            <v-icon>add</v-icon>
        </v-btn>
        <v-card>
            <v-form
                ref="form"
                :value="isValid"
                @submit="save"
            >
                <v-card-title>
                    <span class="headline">{{ header }}</span>
                </v-card-title>
                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field
                                    label="Title"
                                    v-model="model.title"
                                    :rules="validation.title"
                                    @input="clearErrors"
                                    required
                                />
                            </v-flex>
                            <v-flex xs12>
                                <v-select
                                    label="Author"
                                    v-model="model.author_id"
                                    item-text="name"
                                    item-value="id"
                                    :items="authors"
                                    :rules="validation.author_id"
                                    @input="clearErrors"
                                    autocomplete
                                    required
                                />
                            </v-flex>
                            <v-flex xs12>
                                <v-select
                                    label="Genre"
                                    v-model="model.genre_id"
                                    item-value="id"
                                    item-text="title"
                                    :items="genres"
                                    :rules="validation.genre_id"
                                    @input="clearErrors"
                                    autocomplete
                                    required
                                />
                            </v-flex>
                            <v-flex xs12>
                                <v-select
                                    label="Language"
                                    v-model="model.lang"
                                    item-text="title"
                                    item-value="code"
                                    :items="languages"
                                    :rules="validation.lang"
                                    @input="clearErrors"
                                    autocomplete
                                    required
                                />
                            </v-flex>
                            <v-flex xs12>
                                <v-text-field
                                    label="ISBN"
                                    v-model="model.isbn"
                                    :rules="validation.isbn"
                                    @input="clearErrors"
                                    required
                                />
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        flat
                        @click="close"
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        flat
                        type="submit"
                    >
                        Save
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
    import Validator from '../helpers/Validator';
    import {
        mapGetters,
        mapActions,
    } from 'vuex';

    export default {
        computed: {
            ...mapGetters('book', [
                'books',
                'defaultBook',
                'editingBook',
                'formVisibility',
                'authors',
                'genres',
                'languages',
                'errors',
                'responseCode',
            ]),
            header: () =>  this.formItemId ? 'Edit book' : 'Create book',
        },
        data() {
            return {
                isValid: true,
                model: {},
                validation: {
                    title: [
                        title => Validator.required('title', title),
                        () => this.errors.title || true,
                    ],
                    author_id: [
                        id => Validator.required('author', id),
                        id => Validator.in('author', id, this.authors),
                        () => this.errors.author_id || true,
                    ],
                    genre_id: [
                        id => Validator.required('genre', id),
                        id => Validator.in('genre', id, this.genres),
                        () => this.errors.genre_id || true,
                    ],
                    lang: [
                        lang => Validator.required('Language', lang),
                        lang => Validator.in('languages', lang, this.languages, 'code'),
                        () => this.errors.lang || true,
                    ],
                    isbn: [
                        isbn => Validator.required('ISBN', isbn),
                        isbn => Validator.min('ISBN', isbn, 13),
                        isbn => Validator.max('ISBN', isbn, 13),
                        () => this.errors.isbn || true,
                    ],
                },
            };
        },
        mounted() {
            Vue.set(this, 'model', this.editingBook);
        },
        methods: {
            ...mapActions('book', [
                'create',
                'update',
                'openForm',
                'closeForm',
                'setEditing',
                'clearErrors',
            ]),
            validate() {
                return this.$refs.form.validate();
            },
            reset() {
                this.isValid = true;
                this.clearErrors();
                this.setEditing({
                    id: null,
                    title: '',
                    author_id: '',
                    genre_id: '',
                    lang: '',
                    isbn: '',
                });
                Vue.set(this, 'model', this.editingBook);
                this.$refs.form.reset();
            },
            save(event) {
                event.preventDefault();
                if (this.validate()) {
                    if (this.editingBook.id) {
                        this.update({book_id: this.editingBook.id, data: this.model}, this.close);
                    } else {
                        this.create(this.model, this.close);
                    }
                }
            },
            processResponse() {
                if (this.responseCode === 201) {
                    // Show creating new book notification
                    this.close();
                    this.$notify({
                        group: 'messages',
                        title: 'Success!',
                        text: 'Book has been successfully created',
                    });
                } else if (this.responseCode === 200) {
                    // Show updating book notification
                    this.close();
                    this.$notify({
                        group: 'messages',
                        title: 'Success!',
                        text: 'Book has been successfully updated',
                    });
                } else if (this.responseCode === 422) {
                    // trigger validation to displaying backend validation errors
                    this.validate();
                } else {
                    // internal server error
                    this.$notify({
                        group: 'messages',
                        title: 'Oops...',
                        text: 'Something went wrong'
                    });
                }
            },
            open() {
                this.openForm();
            },
            close() {
                this.closeForm();
                this.reset();
            },
            changeVisibility() {
                if (this.formVisibility) {
                    this.close();
                } else {
                    this.open();
                }
            },
        },
        watch: {
            responseCode: 'processResponse',
        },
    }
</script>

<style scoped>

</style>