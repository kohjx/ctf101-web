def grade(arg, key):
    if "flag{h3ll0_fr!3nd}".lower() == key.lower():
        return True, "=)"
    else:
        return False, "..."
