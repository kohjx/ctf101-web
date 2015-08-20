def grade(arg, key):
    if "flag{R3m3mb3r_t0_Ch@ng3_D3f@ult_P@ssw0rd}".lower() == key.lower():
        return True, "=)"
    else:
        return False, "..."
