import { describe, it, expect } from 'vitest'
import { formatRupiah } from './format'

describe('Format Utils', () => {
  it('berhasil mengubah angka jadi format Rupiah', () => {
    // Ubah jadi 'Rp5001' nanti buat bikin pipeline MERAH
    expect(formatRupiah(5000)).toBe('Rp5000') 
  })
})