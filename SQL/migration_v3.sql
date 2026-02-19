-- Migration: Add 'usado' column to transaccion_puntos for tracking used discount cards
ALTER TABLE transaccion_puntos ADD COLUMN IF NOT EXISTS usado TINYINT(1) DEFAULT 0;
