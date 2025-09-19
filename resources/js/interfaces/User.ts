import { UserRole } from '@/constants/enums/UserRole'

export interface BaseUser {
    id?: number,
    name: string,
    email: string,
    role: UserRole,
}

export interface Client extends BaseUser {
    role: UserRole.CLIENTE;
    rfc: string | null;
    phone: string;
    address: string;
}

export interface Worker extends BaseUser {
    role: UserRole.TRABAJADOR;
    phone: string | null;
    address: string | null;
}

export interface Admin extends BaseUser {
    role: UserRole.ADMIN;
}

export type User = Client | Worker | Admin;
