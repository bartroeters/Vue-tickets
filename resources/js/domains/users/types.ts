export interface User {
    id: number
    firstName: string
    lastName: string
    email: string
    isAdmin: boolean
    phonenumber: number
};

export interface UserToRegister extends User {
    password: string
    repeatedPassword: string
};