axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

new Vue({
    el: '#listUser',

    data: {
        lists: [],
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        offset: 4,
        formErrors: {},
        formErrorsUpdate: {},
        newItem: {
            'name': '',
            'email': '',
            'password': '',
            'age': '',
            'sex': '',
            'phone': '',
            'address': '',
            'specialist_id': '0',
            'permission': '',
            'confirm_pass': ''},
        fillItem: {
            'name': '',
            'email': '',
            'age': '',
            'sex': '',
            'phone': '',
            'address': '',
            'specialist_id': '0',
            'permission': '',
        },
        deleteItem: {'name':'','id':''}, 
        listSpecial: {'id': '', 'name': ''},
        searchUser: {'name': ''}
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
            if (to >= this.pagination.last_page) {
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
    mounted : function(){
        $('#sepilisc').hide();
        this.showInfor(this.pagination.current_page);
    },

    methods: {
        showInfor: function(page) {
            axios.get('/admin/user?page='+ page).then(response => {
                this.$set(this, 'lists', response.data.data.data);
                this.$set(this, 'pagination', response.data.pagination);
            })
        },
        editUser: function(item) {
            this.fillItem.id = item.id;
            this.fillItem.name = item.name;
            this.fillItem.email = item.email;
            this.fillItem.address = item.address;
            this.fillItem.phone = item.phone;
            this.fillItem.sex = item.sex;
            this.fillItem.age = item.age;
            this.fillItem.permission = item.permission;
            this.fillItem.specialist_id = item.specialist_id;
            this.showList();
            $('#sepilisc').hide();

            if ( this.fillItem.permission == 2 ) {
                $('#sepilisc').show('1000');
            } else {
                $('#sepilisc').hide('1000');
                this.fillItem.specialist_id = 0; 
            }
            $('#editUser').modal('show');
        },

        updateItem: function(id){
            if (!confirm('Do you want to update this user!')) return;
            var input = this.fillItem;
            axios.put('/admin/user/'+id, input).then((response) => {
                this.changePage(this.pagination.current_page);
                $("#editUser").modal('hide');
                if (response.data.status == 'error') {
                    toastr.error(response.data.message, response.data.action, {timeOut: 5000});
                } else {
                    toastr.success('', response.data.action, {timeOut: 5000});
                }
            }).catch((error) => {
                if (error.response.status == 422) {
                    this.formErrorsUpdate = error.response.data;
                }
            });
        },
        searchUserNew: function(event) {
            this.searchUser.name= event.target.value;
            var authOptions = {
                    method: 'post',
                    url: '/admin/searchUser',
                    params: this.searchUser.name,
            }
            axios(authOptions).then(response => {
                this.$set(this, 'lists', response.data);
            }).catch((error) => {
                this.showInfor(this.pagination.current_page);
            });
        },
        showUser: function(item) {
            this.fillItem.id = item.id;
            this.fillItem.name = item.name;
            this.fillItem.email = item.email;
            this.fillItem.address = item.address;
            this.fillItem.phone = item.phone;
            this.fillItem.sex = item.sex;
            this.fillItem.age = item.age;
            this.fillItem.permission = item.permission;
            this.fillItem.specialist_id = item.specialist_id;

            $('#infoUser1').modal('show');
        },

        changePage: function (page) {
            this.pagination.current_page = page;
            this.showInfor(page);
        },

        specialist: function(event) {
            var permistion = event.target.value;
            if ( permistion == 2 ) {
                this.showList();
                $('#sepilisc').show('1000');
            } else {
                $('#sepilisc').hide('1000');
                this.fillItem.specialist_id = 0; 
            }
        },
        
        deleteUser: function(id) {
            swal({
                    title: 'Are you sure? ',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
                }).then(function () {
                    var authOptions = {
                        method: 'DELETE',
                        url: '/admin/patient/' + id,
                        json: true
                    }
                    axios(authOptions).then(response => {
                        swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                        $("#User-" + id).remove();
                    });   
                }, function (dismiss) {
                    if (dismiss === 'cancel') {
                        swal(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                        );
                    }
            }); 
        },
        addUser: function() {
            $('#adduser').modal('show');
        },

        createItem: function(){
            if (!confirm('Do you want to create this user!')) return;
            var input = this.newItem;
            axios.post('/admin/user', input).then((response) => {
                if (response.data.status == 'error') {
                    toastr.error(response.data.message, response.data.action, {timeOut: 5000});
                } else {
                    toastr.success(response.data.message, response.data.action, {timeOut: 5000});
                    this.newItem = {
                        'name': '',
                        'email': '',
                        'password': '',
                        'age': '',
                        'sex': '',
                        'phone': '',
                        'address': '',
                        'specialist_id': 0,
                        'permission': '',
                        'confirm_pass': ''
                    };
                    this.formErrors = '';
                    this.showInfor(this.pagination.current_page);
                }
            }).catch((error) => {
                this.formErrors = error.response.data;
                console.log(this.formErrors);
            });
        },

        showList: function() {
            var self = this;
            var authOptions = {
                    method: 'GET',
                    url: '/admin/list-specialist',
                    json: true
                }
            axios(authOptions).then((response) => {
                this.$set(this, 'listSpecial', response.data);
            }).catch((error) => {
            });
        },
    }
});

Vue.config.devtools = true;
