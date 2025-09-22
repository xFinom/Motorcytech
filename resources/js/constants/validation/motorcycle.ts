import { z } from 'zod'

export const motorcycleSchema = z.object({
    serial_num: z.string(),
    motor_num: z.string(),
    placa: z.string(),
    brand_id: z.number().int().positive(),
    type_id: z.number().int().positive(),
    year: z.number().int().positive(),
});

export type MotorcycleForm = z.infer<typeof motorcycleSchema>;
