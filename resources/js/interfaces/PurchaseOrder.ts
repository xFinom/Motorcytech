import { Client } from '@/interfaces/User'
import { StoreItem } from '@/interfaces/StoreItem'

export interface PurchaseOrder {
    id: number;
    client: Client;
    items: StoreItem[];
}
