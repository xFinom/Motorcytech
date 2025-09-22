import { ServiceOrderStatus } from '@/enums/ServiceOrderStatus'
import { Motorcycle } from '@/interfaces/Motorcycle'
import { Client } from '@/interfaces/User'
import { Service } from '@/interfaces/Service'
import { PaginatedList } from '@/interfaces/PaginatedList'
import { ServiceOrderSparePart } from '@/interfaces/ServiceOrderSparePart'
import { ServiceOrderBill } from '@/interfaces/ServiceOrderBill'
import { PrivateMessage } from '@/interfaces/PrivateMessage'

export interface ServiceOrder {
    id: string;
    entry_date: string;
    delivery_date: string;
    note: string;
    status: ServiceOrderStatus;
    motorcycle: Motorcycle;
    client: Client;
    service: Service;
    spareParts?: ServiceOrderSparePart[];
    bills?: ServiceOrderBill[];
    privateMessages?: PrivateMessage[];
}

export type PaginatedServiceOrderList = PaginatedList<ServiceOrder>
