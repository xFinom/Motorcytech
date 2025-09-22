export interface PaginatedList<T = any> {
    data: T[];
    current_page: number;
    last_page: number;
}
