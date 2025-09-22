import { z } from 'zod'

export const serviceSchema = z.object({
    service_id: z.number().int().positive(),
    note: z.string().optional(),
});

export type ServiceForm = z.infer<typeof serviceSchema>;
