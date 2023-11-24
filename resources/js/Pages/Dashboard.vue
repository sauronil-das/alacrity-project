<template>
    <MainLayout>
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Loan ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Loan Date</th>
                        <th>Repayment Frequency</th>
                        <th>Interest Rate</th>
                        <th>Repayment Amount</th>
                        <th>Repayment Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="loan in loans" :key="loan.id">
                        <td>{{ loan.id }}</td>
                        <td>{{ loan.user_id }}</td>
                        <td>{{ loan.amount }}</td>
                        <td>{{ loan.loan_date }}</td>
                        <td>{{ loan.repayment_frequency }}</td>
                        <td>{{ loan.interest_rate }}</td>
                        <td>{{ loan.repayment_amount }}</td>
                        <td>{{ loan.repayment_status }}</td>
                        <td>{{ loan.loan_status }}</td>
                        <td>
                            <button class="btn btn-danger" @click="deleteLoan(loan)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>BRP</th>
                        <th>Passport</th>
                        <th>Sort Code</th>
                        <th>Account Number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.BRP }}</td>
                        
                        <td>{{ user.passport_number }}</td>
                        <td>{{ user.sort_code }}</td>
                        <td>{{ user.bank_account }}</td>
                        <td>
                            <button class="btn btn-danger" @click="deleteUser(user)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </MainLayout>
</template>
  
<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    components: {
        MainLayout
    },
    props: 
     {
        loans: {
            required: true,
            type: Array
        }, 
        users: {
            required: true,
            type: Array
        }
        
    },

    mounted() {
        // this.fetchLoans();
        // this.fetchUsers();
    },

    methods: {

        deleteUser(user) {
            if (confirm("Are you sure you want to delete " + user.name + "?"))
            {
                // send api 
                axios.delete(route('users.destroy', user))
                    .then(response => {
                        alert('deleted!');
                        this.users.splice(this.users.indexOf(user), 1);
                    });
            }
        },
        deleteLoan(loan) {
            if (confirm("Are you sure you want to delete " + loan.id + "?"))
            {
                // send api 
                axios.delete(route('loans.destroy', loan))
                    .then(response => {
                        alert('deleted!');
                        this.loans.splice(this.loans.indexOf(loan), 1);
                    });
            }
        },

        fetchLoans() {
            axios
                .get("/api/loans")
                .then((response) => {
                    this.loans = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching loans:", error);
                });
        },
        fetchUsers() {
            axios
                .get("/api/users")
                .then((response) => {
                    this.users = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching users:", error);
                });
        },
    },
};
</script>