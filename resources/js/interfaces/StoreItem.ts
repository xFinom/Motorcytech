import { PurchaseOrder } from '@/interfaces/PurchaseOrder'

export interface StoreItem {
    id: number;
    name: string;
    description: string|null;
    quantity: number;
    price: number;
    purchaseOrders: PurchaseOrder[];
}
